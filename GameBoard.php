<?php

class GameBoard {
    private const NUM_SQUARES_ON_BOARD = 9*9;
    private const ROW_LENGTH = 9;
    private const SQUARE_LENGTH = 3;

    private $board;

    public function __construct()
    {
        $board = func_get_args();

        if (count($board) !== self::NUM_SQUARES_ON_BOARD) {
            throw new \InvalidArgumentException('invalid board size');
        }

        // TODO check types of incoming values to ensure int

        $this->board = $board;
    }


    /**
     * Returns an array of all possible next moves for the next empty square.
     * 
     * This function assumes the GameBoard has a solution.
     * 
     * @return GameBoard[] list of game boards representing list of possible next moves.
     */
    public function nextMoves() : array
    {

        //TODO distinguish no more moves but game unsolved and no more moves because game is solved?


        $next_empty_index = $this->find_next_empty_space();
        if (is_null($next_empty_index)) {
            return []; // TODO caller needs to check if the board is solved.
        }

        $legal_numbers = $this->calculate_legal_moves($next_empty_index);

        return array_map(function($number) use ($next_empty_index) { 
            $board = $this->board;
            $board[$next_empty_index] = $number;
            return new GameBoard(...$board);
        }, $legal_numbers);
    }

    private function find_next_empty_space()
    {
        $next = array_search(0, $this->board);
        return $next === false ? null : $next;
    }

    private function calculate_legal_moves($empty_index)
    {
        static $digits = [1, 2, 3, 4, 5, 6, 7, 8, 9];

        // list of non-zero values in the current row
        $current_row = $this->current_row($empty_index);
        $legal_row_numbers = array_diff($digits, $current_row);

        // list of non-zero values in the current column
        $current_col = $this->current_col_numbers($empty_index);
        $legal_col_numbers = array_diff($digits, $current_col);

        // list of non-zero values in the current square
        $current_square = $this->current_square($empty_index);
        $legal_square_numbers = array_diff($digits, $current_square);

        // TODO come back and think about whether preservation of keys is important here.

        return array_values(array_intersect($legal_row_numbers,
                                            $legal_col_numbers, 
                                            $legal_square_numbers));
    }

    private function current_row($index)
    {
        return array_slice($this->board, self::row_num($index) * self::ROW_LENGTH, self::ROW_LENGTH);
    }

    private static function row_num($index)
    {
        return floor($index / self::ROW_LENGTH);
    }

    private function current_col_numbers($index)
    {
        $col = self::col_num($index);

        $column_numbers = [];
        for ($i = $col; $i < self::NUM_SQUARES_ON_BOARD; $i += self::ROW_LENGTH) {
            $column_numbers[] = $this->board[$i];
        }

        return $column_numbers;
    }

    private static function col_num($index)
    {
        return $index % self::ROW_LENGTH;
    }

    private function current_square($index)
    {
        $square_numbers = [];

        $sqr_i = self::first_index_in_square($index);
        for ($row = 0; $row < self::SQUARE_LENGTH; ++$row) {
            for ($col = 0; $col < self::SQUARE_LENGTH; ++$col) {
                $square_numbers[] = $this->board[$sqr_i++];
            }
            // set $sqr_i to first index on the next line inside the square
            $sqr_i = $sqr_i - self::SQUARE_LENGTH + self::ROW_LENGTH;
        }

        return $square_numbers;
    }

    private static function first_index_in_square($index)
    {
        // square number (based on row) * square length * row length + square number (based on col) * square length
        $sqr_num_r = floor(self::row_num($index) / self::SQUARE_LENGTH);
        $sqr_num_c = floor(self::col_num($index) / self::SQUARE_LENGTH);

        return $sqr_num_r * self::SQUARE_LENGTH * self::ROW_LENGTH + $sqr_num_c * self::SQUARE_LENGTH;
    }

    public function is_solved()
    {
        return is_null($this->find_next_empty_space());
    }
}
