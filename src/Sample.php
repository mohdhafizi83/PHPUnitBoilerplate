<?php

// Start session if not already active
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

class Sample
{    
    public function resetSession(): void
    {
        unset($_SESSION['numberA']);
        unset($_SESSION['numberB']);
        
        foreach ($_SESSION as $key => $value) {
            // Regular expression to match the pattern
            if (preg_match('/^\d{12}_.+$/', $key)) {
                unset($_SESSION[$key]);
            }
        }
    
    }

}
