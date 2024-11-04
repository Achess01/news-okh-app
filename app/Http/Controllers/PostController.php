<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\PostReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::when(Auth::check(), function ($query) {
            return $query->with(['reports' => function ($query) {
                $query->where('user_id', Auth::id());
            }]);
        })
            ->where('status', PostStatus::published->value)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate()
            ->through(function ($post) {
                $userId = Auth::id();

                $post->canSubscribe = $post->notificateTo()->where('user_id', $userId)->count() < 1;

                $post->canEdit = $userId && $post->user_id === $userId;


                $post->canReport = $userId && $post->reports->isEmpty() && $post->user_id !== $userId;


                unset($post->reports);

                return $post;
            });

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Post $post)
    {
        return view('posts.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'body' => 'required|string',
            'event_date' => 'required|date',
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'place' => $validated['place'],
            'body' => $validated['body'],
            'event_date' => $validated['event_date'],
            'status' => auth()->user()->can('publish without review') ? PostStatus::published->value : PostStatus::publishReview->value,
        ]);

        return redirect()->route('posts.my_posts')->with('success', 'Publicación realizada correctamente');
    }

    public function show_reported(Post $post)
    {
        if ($post->status !== PostStatus::reportedReview->value) {
            abort(404);
        }
        return view('posts.show_reported', compact('post'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'body' => 'required|string',
            'event_date' => 'required|date',
        ]);

        $post->update([
            'title' => $validated['title'],
            'place' => $validated['place'],
            'body' => $validated['body'],
            'event_date' => $validated['event_date'],
        ]);

        return redirect()->route('posts.my_posts')->with('success', 'Publicación actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back()->with('success', 'El post se ha eliminado correctamente');
    }

    public function report(Request $request, Post $post)
    {
        $request->validate([
            'reported_reason' => 'required|string|max:255',
        ]);

        PostReport::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'reported_reason' => $request->reported_reason,
            'reported_at' => now(),
        ]);

        $qty = $post->reports()->count();
        if ($qty >= 3) {
            $post->update([
                'status' => PostStatus::reportedReview
            ]);
        }

        return redirect()->back()->with('success', 'El post ha sido reportado correctamente.');

    }

    public function my_posts(Request $request)
    {
        $posts = Post::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate()
            ->through(function ($post) {
                $post->canEdit = true;
                $post->canSubscribe = false;
                $post->canReport = false;
                return $post;
            });

        return view('posts.my_posts', [
            'posts' => $posts
        ]);
    }

    public function reported(Request $request)
    {
        $posts = Post::where('status', PostStatus::reportedReview->value)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate()
            ->through(function ($post) {
                $post->canEdit = false;
                $post->canSubscribe = false;
                $post->canReport = false;
                $post->user_name = $post->user ? $post->user->name . '(' . $post->user->email . ')' : '';

                return $post;
            });

        return view('posts.reported', [
            'posts' => $posts
        ]);
    }

    public function accept_reports(Post $post): \Illuminate\Http\RedirectResponse
    {
        $post->update([
            'status' => PostStatus::reportedAccepted->value
        ]);

        $hasProPublisherRole = $post->user->hasRole('pro_publisher');
        $hasBasicPublisherRole = $post->user->hasRole('basic_publisher');
        $message = '';
        if ($hasProPublisherRole) {
            $post->user->syncRoles(['basic_publisher']);
            $message = 'El usuario ' . $post->user->email . ' perdió el permiso para publicar sin revisión';
        } else if ($hasBasicPublisherRole) {
            $post->user->removeRole('basic_publisher');
            $message = 'El usuario ' . $post->user->email . ' ya no podrá hacer publicaciones';
        }

        return redirect()->route('posts.reported_posts')->with('success', $message);
    }

    public function ignore_reports(Post $post): \Illuminate\Http\RedirectResponse
    {
        $post->update([
            'status' => PostStatus::published->value
        ]);

        PostReport::where('post_id', $post->id)->delete();

        return redirect()->route('posts.reported_posts')->with('success', "El post '{$post->title}' ha regresado a la pantalla principal");
    }

    public function review(Request $request)
    {
        $posts = Post::where('status', PostStatus::publishReview->value)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate()
            ->through(function ($post) {
                $post->canEdit = false;
                $post->canSubscribe = false;
                $post->canReport = false;
                $post->user_name = $post->user ? $post->user->name . '(' . $post->user->email . ')' : '';

                return $post;
            });

        return view('posts.review', [
            'posts' => $posts
        ]);
    }

    public function show_review(Post $post)
    {
        if ($post->status !== PostStatus::publishReview->value) {
            abort(404);
        }
        return view('posts.show_review', compact('post'));
    }

    public function accept_post(Post $post): \Illuminate\Http\RedirectResponse
    {
        $post->update([
            'status' => PostStatus::published->value
        ]);

        $message = "El post '{$post->title}' ha sido aprobado";
        if ($post->user->hasRole('basic_publisher')) {
            $posts = Post::where('status', PostStatus::published->value)->where('user_id', $post->user->id);
            if ($posts->count() >= 2) {
                $post->user->syncRoles(['pro_publisher']);
            }

            $message = $message . " El usuario {$post->user->email} ahora puede publicar sin revisión";
        }


        return redirect()->route('posts.review')->with('success', $message);
    }

    public function reject_post(Post $post): \Illuminate\Http\RedirectResponse
    {
        $post->update([
            'status' => PostStatus::publishRejected->value
        ]);

        return redirect()->route('posts.review')->with('success', "El post '{$post->title}' ha sido rechazado");
    }

    public function subscribe_user(Post $post): \Illuminate\Http\RedirectResponse
    {
        $subscribed = auth()->user()->notificationsPost()->where('post_id', $post->id)->count() > 0;

        if (!$subscribed) {
            auth()->user()->notificationsPost()->attach($post);
        }
        return redirect()->back()->with('success', "Revisa tus notificaciones para más información");
    }

    public function unsubscribe_user(Post $post): \Illuminate\Http\RedirectResponse
    {
        auth()->user()->notificationsPost()->where('post_id', $post->id)->delete();
        return redirect()->back()->with('success', "Notificación removida");
    }
}
