<?php

namespace App\Enums;

enum TaxonomyType: string
{
    case CATEGORY = 'category';
    case VENDOR = 'vendor';
    case VENUE = 'venue';
    case LOCATION = 'location';
    case SERVICE = 'service';
    case EVENT = 'event';
    case OTHER = 'other';
}