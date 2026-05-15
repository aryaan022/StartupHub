<?php

// config/permissions.php
// Role-based permissions configuration

return [
    'roles' => [
        'admin' => [
            // User management
            'manage_users',
            'verify_users',
            'ban_users',
            'delete_users',

            // Startup management
            'manage_startups',
            'verify_startups',
            'featured_startups',
            'delete_startups',

            // Content moderation
            'moderate_content',
            'remove_listings',
            'flag_inappropriate',

            // Reporting
            'view_analytics',
            'view_reports',
            'export_data',

            // System
            'manage_config',
            'view_logs',
            'manage_email',
        ],

        'founder' => [
            // Own startup
            'create_startup',
            'edit_own_startup',
            'delete_own_startup',
            'manage_team',

            // Jobs
            'post_jobs',
            'manage_own_jobs',
            'view_applications',
            'respond_to_applications',

            // Investor relations
            'view_investor_profiles',
            'contact_investors',
            'receive_investment_proposals',
            'manage_investments',

            // Analytics
            'view_own_analytics',
            'view_profile_views',

            // Messaging
            'send_messages',
            'receive_messages',
        ],

        'investor' => [
            // Discovery
            'view_startups',
            'filter_startups',
            'search_startups',

            // Investments
            'send_investment_proposals',
            'manage_portfolio',
            'view_investments',

            // Watchlist
            'create_watchlist',
            'manage_watchlist',

            // Messaging
            'contact_founders',
            'send_messages',
            'receive_messages',
        ],

        'job_seeker' => [
            // Profile
            'create_profile',
            'edit_profile',
            'upload_resume',

            // Job search
            'view_jobs',
            'search_jobs',
            'filter_jobs',
            'apply_jobs',

            // Applications
            'view_applications',
            'track_applications',
            'withdraw_applications',

            // Messaging
            'message_founders',
            'receive_messages',
        ],

        'partner' => [
            // Discovery
            'view_startups',

            // Collaboration
            'propose_collaboration',
            'send_messages',
            'receive_messages',
        ],
    ],

    'features' => [
        'two_factor_auth' => true,
        'oauth_login' => true,
        'messaging' => true,
        'notifications' => true,
        'activity_logging' => true,
        'advanced_search' => true,
    ],
];
