<?php 

namespace App\Manager;

use App\Form\FriendshipFormType;
use App\Entity\Character;
use App\Entity\Enum\FriendshipType;


class CharacterCollectionManager {

    private $characterArray = array();

    public function __construct(){
        
    }

    public function getCharacterArray() :array
    {
        return $this->characterArray;
    }

    public function setCharacterArray(array $charactersArray){
        $this->characterArray = $charactersArray;
    }

    public function isMyFriend(string $name){
        
        $character = $this->getSpecificCharacter($name);
        foreach($character->getCharacters() as $friend){
            if($friend->getname() == 'Moi'){
                return true;
            }
        }
        return false;
    }

    public function addToArray(array $datas){
        //init array if empty
        if(empty($this->characterArray)){
            $this->initCharacterArray();
        }

        //add or update to CharactersArray
        switch($datas[FriendshipFormType::FRIENDSHIP_TYPE]){
            case FriendshipType::I_AM_FRIEND_WITH:
                
                $meCharacter = $this->getSpecificCharacter("Moi");

                if(!$this->checkIfCharacterAlreadyExist($datas[FriendshipFormType::SECOND_CHARACTER])){
                    
                    $character = new Character();
                    $character->setName($datas[FriendshipFormType::SECOND_CHARACTER]);
                    $character->addCharacter($meCharacter);

                    $meCharacter->addCharacter($character);

                    $this->characterArray[] = $character;
                }else{
                    //add link to existing character
                    $characterToUpdate = $this->getSpecificCharacter($datas[FriendshipFormType::SECOND_CHARACTER]);
                    $characterToUpdate->addCharacter($meCharacter);

                    $meCharacter->addCharacter($characterToUpdate);

                    $this->updateSpecificCharacter($characterToUpdate);
                }
                $this->updateSpecificCharacter($meCharacter);
                break;

            case FriendshipType::IS_MY_FRIEND:
                $meCharacter = $this->getSpecificCharacter("Moi");

                if(!$this->checkIfCharacterAlreadyExist($datas[FriendshipFormType::FIRST_CHARACTER])){
                    $character = new Character();
                    $character->setName($datas[FriendshipFormType::FIRST_CHARACTER]);
                    $character->addCharacter($meCharacter);

                    $meCharacter->addCharacter($character);

                    $this->characterArray[] = $character;
                }else{
                    //add i am friend with
                    $characterToUpdate = $this->getSpecificCharacter($datas[FriendshipFormType::FIRST_CHARACTER]);
                    $characterToUpdate->addCharacter($meCharacter);

                    $meCharacter->addCharacter($characterToUpdate);

                    $this->updateSpecificCharacter($characterToUpdate);
                }

                $this->updateSpecificCharacter($meCharacter);
                break;

            case FriendshipType::IS_FRIEND_WITH:
                //check if first caracter exist or not
                if(!$this->checkIfCharacterAlreadyExist($datas[FriendshipFormType::FIRST_CHARACTER])){
                    $firstCharacter = new Character();
                    $firstCharacter->setname($datas[FriendshipFormType::FIRST_CHARACTER]);
                    $firstAlreadyExists = false;
                }else{
                    $firstCharacter = $this->getSpecificCharacter($datas[FriendshipFormType::FIRST_CHARACTER]);
                    $firstAlreadyExists = true;
                }

                //check if second caracter exist or not
                if(!$this->checkIfCharacterAlreadyExist($datas[FriendshipFormType::SECOND_CHARACTER])){
                    $secondCharacter = new Character();
                    $secondCharacter->setname($datas[FriendshipFormType::SECOND_CHARACTER]);
                    $secondAlreadyExists = false;
                }else{
                    $secondCharacter = $this->getSpecificCharacter($datas[FriendshipFormType::SECOND_CHARACTER]);
                    $secondAlreadyExists = true;
                }

                $firstCharacter->addCharacter($secondCharacter);
                $secondCharacter->addCharacter($firstCharacter);

                $firstAlreadyExists ? $this->updateSpecificCharacter($firstCharacter) : $this->characterArray[] = $firstCharacter;
                $secondAlreadyExists ? $this->updateSpecificCharacter($secondCharacter) : $this->characterArray[] = $secondCharacter;              
        }
    }

    private function checkIfCharacterAlreadyExist(string $name){
        foreach($this->characterArray as $character){
            if($character->getname() === $name){
                return true;
            }
        }
        return false;
    }

    private function getSpecificCharacter(string $name){
        foreach($this->characterArray as $character){
            if($character->getname() === $name){
                return $character;
            }
        }
        return false;
    }

    private function updateSpecificCharacter(Character $character){
        for($i = 0; $i < count($this->characterArray); $i++){
            if($this->characterArray[$i]->getname() === $character->getname()){
                $this->characterArray[$i] = $character;
            }
        }
    }

    private function initCharacterArray(){
        $this->characterArray = array();
        $me = new Character();
        $me->setName("Moi");
        $this->characterArray[] = $me;
    }
}