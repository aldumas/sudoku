<?php

class GameBoard {
    private const BOARD_DIM = 9;
    private const SQUARE_DIM = 3;
    private const NUM_SQUARES_PER_DIM = self::BOARD_DIM / self::SQUARE_DIM;

    private $board;

    public function __construct()
    {
        $board = func_get_args(); // TODO make this a 2D array to simplify the math. 

        if (count($board) != self::BOARD_DIM * self::BOARD_DIM) {
            throw new \InvalidArgumentException('invalid board size');
        }

        // TODO check types of incoming values to ensure int and in range

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
        return array_slice($this->board, self::row_num($index) * self::BOARD_DIM, self::BOARD_DIM);
    }

    private static function row_num($index)
    {
        return floor($index / self::BOARD_DIM);
    }

    private function current_col_numbers($index)
    {
        $col = self::col_num($index);

        $num_squares_on_board = pow(self::SQUARE_DIM
, 4);

        $column_numbers = [];
        for ($i = $col; $i < $num_squares_on_board; $i += self::BOARD_DIM) {
            $column_numbers[] = $this->board[$i];
        }

        return $column_numbers;
    }

    private static function col_num($index)
    {
        return $index % self::BOARD_DIM;
    }

    private function current_square($index)
    {
        $square_numbers = [];

        $sqr_i = self::first_index_in_square($index);
        for ($row = 0; $row < self::SQUARE_DIM
; ++$row) {
            for ($col = 0; $col < self::SQUARE_DIM
    ; ++$col) {
                $square_numbers[] = $this->board[$sqr_i++];
            }
            // set $sqr_i to first index on the next line inside the square
            $sqr_i = $sqr_i - self::SQUARE_DIM
     + self::BOARD_DIM;
        }

        return $square_numbers;
    }

    private static function first_index_in_square($index)
    {
        // square number (based on row) * square length * row length + square number (based on col) * square length
        $sqr_num_r = floor(self::row_num($index) / self::SQUARE_DIM);
        $sqr_num_c = floor(self::col_num($index) / self::SQUARE_DIM);

        return $sqr_num_r * self::SQUARE_DIM
 * self::BOARD_DIM + $sqr_num_c * self::SQUARE_DIM
;
    }

    public function is_solved()
    {
        return is_null($this->find_next_empty_space());
    }
}
