<?php

require_once 'GameBoard.php';

class Game {
    public static function solve(GameBoard $board) {
        return [];

        //brute force, keep a stack of all possible moves. keep pushing until no solutions.

        //heuristic: look for cells where there is only 1 possible next move. keep doing that until you have to do the above and make a choice. keep checking for only 1 possible move.



    }

    private static function solve_brute_force(GameBoard $board)
    {
        $stack = [];

        
    }
}