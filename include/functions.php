<?php
    function typeBadge($type) {
        $type_lower = strtolower($type);
        $classes = [
            'criminal'   => 'badge-custom badge-criminal',
            'family'     => 'badge-custom badge-family',
            'civil'      => 'badge-custom badge-civil',
            'commercial' => 'badge-custom badge-commercial',
        ];
        $class = $classes[$type_lower] ?? 'badge-custom badge-civil';
        return '<span class="'.$class.'">'.htmlspecialchars(strtoupper($type)).'</span>';
    }

    function statusBadge($status) {
        $status_lower = strtolower($status);
        $classes = [
            'open'      => 'badge-custom badge-open',
            'pending'   => 'badge-custom badge-pending',
            'dismissed' => 'badge-custom badge-dismissed',
            'appeal'    => 'badge-custom badge-appeal',
            'closed'    => 'badge-custom badge-closed',
        ];
        $class = $classes[$status_lower] ?? 'badge-custom badge-closed';
        return '<span class="'.$class.'">'.htmlspecialchars(strtoupper($status)).'</span>';
    }

    function priorityBadge($priority) {
        $priority_lower = strtolower($priority);
        $classes = [
            'high'   => 'badge-custom badge-high',
            'medium' => 'badge-custom badge-medium',
            'low'    => 'badge-custom badge-low',
        ];
        $class = $classes[$priority_lower] ?? 'badge-custom badge-low';
        return '<span class="'.$class.'">'.htmlspecialchars(strtoupper($priority)).'</span>';
    }

?>