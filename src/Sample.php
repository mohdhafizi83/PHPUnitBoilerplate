<?php

declare(strict_types=1);

namespace App;

class Sample
{
    /**
     * Remove known session keys and any keys matching the
     * "<12-digit-id>_<name>" pattern from the given session array.
     *
     * @param array<string, mixed> $session
     */
    public function resetSession(array &$session): void
    {
        unset($session['numberA'], $session['numberB']);

        foreach (array_keys($session) as $key) {
            if (preg_match('/^\d{12}_.+$/', (string) $key) === 1) {
                unset($session[$key]);
            }
        }
    }
}
