<?php

namespace Helious\SeatTokens\Observers;

use Seat\Eveapi\Models\Character\CharacterInfo;
use Seat\Eveapi\Models\RefreshToken;

class CharacterInfoObserver
{

    /**
     * @param  \Seat\Eveapi\Models\CharacterInfo  $character
     */
    public function softDeleted(CharacterInfo $character)
    {
        $this->deleted($character);
    }

    /**
     * @param  \Seat\Eveapi\Models\CharacterInfo  $character
     */
    public function deleted(CharacterInfo $character)
    {
      \Log::error($character);
    }
    
}