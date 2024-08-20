<?php

namespace Helious\SeatTokens\Observers;

use Seat\Eveapi\Models\Character\CharacterInfo;
use Seat\Eveapi\Models\RefreshToken;

class CharacterInfoObserver
{

    /**
     * Handle the soft deleted event for the character.
     *
     * @param  \Seat\Eveapi\Models\Character\CharacterInfo  $character
     * @return void
     */
    public function softDeleted(CharacterInfo $character)
    {
        $this->deleted($character);
    }

    /**
     * Handle the deleted event for the character.
     *
     * @param  \Seat\Eveapi\Models\Character\CharacterInfo  $character
     * @return void
     */
    public function deleted(CharacterInfo $character)
    {
      $token = RefreshToken::where('character_id', $character->character_id)->first();

      if ($token) {
        $token->delete();
        logger()->alert(sprintf("Token for character %s (ID: %s) has been deleted.", $character->name, $character->character_id));
      } else {
        logger()->alert(sprintf("No token found for character %s (ID: %s) to delete.", $character->name, $character->character_id));
      }
    }
}
