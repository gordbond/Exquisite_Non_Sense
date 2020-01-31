<?php
    /* 
    Final Project - "Exquisite Non-Sense"
    Gord Bond, 000786196
    I, Gord Bond, 000786196, certify that this material is my original work. 
    No other person's work has been used without due acknowledgement.

    Summary:

    fullDrawing.php contains a class called fullDrawings which holds all the 
    information for a full drawing. This includes:
        - head image path
        - body image path
        - legs image path
        - head ID
        - body ID
        - legs ID

        This class is used by the getImg.php file to construct a JSON object
    */

    class fullDrawing implements JsonSerializable{

        //head image path
        private $head;
        //body image path
        private $body;
        //legs image path
        private $legs;
        //head ID
        private $headID;
        //body ID
        private $bodyID;
        //legs ID
        private $legsID;

        /**
         * Constructor for fullDrawing
         * Sets each instance variable
         * @param head head image path
         * @param body body image path
         * @param legs body image path
         * @param headID headID
         * @param bodyID bodyID
         * @param legsID legsID
         */
        function __construct($head, $body, $legs, $headID, $bodyID, $legsID){
            $this->head = $head;
            $this->body = $body;
            $this->legs = $legs;
            $this->headID = $headID;
            $this->bodyID = $bodyID;
            $this->legsID = $legsID;
        }

    
        /**
         * Allows class objects to be converted to JSON
         */
        public function jsonSerialize()
        {
            return  get_object_vars($this);
        }

    }


?>