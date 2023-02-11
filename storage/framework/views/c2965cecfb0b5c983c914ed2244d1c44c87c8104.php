<?php
    $progressSteps = [
        1 => [
            'name' => 'basic_information',
            'icon' => 'paper'
        ],

        2 => [
            'name' => 'extra_information',
            'icon' => 'paper_plus'
        ],

        // 3 => [
        //     'name' => 'pricing',
        //     'icon' => 'wallet'
        // ],

        4 => [
            'name' => 'content',
            'icon' => 'folder'
        ],

        5 => [
            'name' => 'prerequisites',
            'icon' => 'video'
        ],

        6 => [
            'name' => 'faq',
            'icon' => 'tick_square'
        ],

        7 => [
            'name' => 'quiz_certificate',
            'icon' => 'ticket_star'
        ],

        8 => [
            'name' => 'message_to_reviewer',
            'icon' => 'shield_done'
        ],
    ];

    $currentStep = empty($currentStep) ? 1 : $currentStep;
?>



<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/web/default/panel/webinar/create_includes/progress.blade.php ENDPATH**/ ?>