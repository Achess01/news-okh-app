<?php

namespace App\Enums;

enum PostStatus: string {
    case publishReview = 'Pendiente de publicar';
    case published = 'Publicado';
    case reportedReview = 'Revisión de reportes';
    case reportedAccepted = 'Reporte aceptado';
}
