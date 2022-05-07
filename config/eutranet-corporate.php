<?php

return [
    'name' => 'Laravel Corporate',
    'description' => 'Eutranet\'s Laravel Corporate is a corporate\'s dashboard.',
    'migrations' => [],
    'tables' => [
        'agreements',
        'consultations',
        'contact_attempts',
        'corporates',
        'agencies',
        'corporate_staff_member',
        'corporate_general_terms',
        'feedbacks',
        'staff_portfolio',
        'services',
        'service_fees'
    ],
    'models' => [
        'Agency',
        'Consultation',
        'ContactAttempt',
        'Corporate',
        'CorporateAgreement',
        'CorporateGeneralTerm',
        'CorporateStaffMember',
        'Feedback',
        'ServiceFee',
        'StaffMember',
        'StaffTeam',
        'StaffPortfolio',
        'Team',
        'User',
    ],
];
