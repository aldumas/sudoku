<?php

class GameBoard {
    private const BOARD_DIM = 9;
    private const SQUARE_DIM = 3;
    private const NUM_SQUARES_PER_DIM = self::BOARD_DIM / self::SQUARE_DIM;
    private const ALL_NUMBERS = [1,2,3,4,5,6,7,8,9];

    private $board;

    public function __construct()
    {
        $board = func_get_args();

        if (empty($board)) {
            throw new \InvalidArgumentException('missing argument(s)');
        }

        $this->board = is_array($board[0]) ?
            self::create_board_from_2d_array($board[0]) :
            self::create_board_from_1d_array($board);

        // TODO validate types and values (1-9)
    }

    private static function create_board_from_2d_array($board)
    {
        if (count($board) !== self::BOARD_DIM) {
            throw new \InvalidArgumentException('invalid number of rows');
        }

        foreach ($board as $i => $row) {
            if (count($row) !== self::BOARD_DIM) {
                throw new \InvalidArgumentException("invalid number of columns in row $i");
            }
        }

        return $board;
    }

    private static function create_board_from_1d_array($board)
    {
        if (count($board) != self::BOARD_DIM * self::BOARD_DIM) {
            throw new \InvalidArgumentException('invalid board size');
        }

        return array_chunk($board, self::BOARD_DIM);
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

        $empty_cell_coords = $this->find_next_empty_cell_coordinates();
        if (is_null($empty_cell_coords)) {
            return []; // TODO caller needs to check if the board is solved.
        }

        $legal_numbers = $this->calculate_legal_moves($empty_cell_coords);

        return array_map(function($number) use ($empty_cell_coords) { 
            $board = $this->board;
            $board[$empty_cell_coords->row][$empty_cell_coords->col] = $number;
            return new self($board);
        }, $legal_numbers);
    }

    private function find_next_empty_cell_coordinates()
    {
        for ($row = 0; $row < self::BOARD_DIM; ++$row) {
            $col = array_search(0, $this->board[$row]);
            if ($col !== false)
                return new Cell($row, $col);
        }

        return null;
    }

    private function calculate_legal_moves($empty_cell_coords)
    {
        // list of non-zero values in the current row
        $current_row_numbers = $this->current_row_numbers($empty_cell_coords);
        $legal_row_numbers = array_diff(self::ALL_NUMBERS, $current_row_numbers);

        // list of non-zero values in the current column
        $current_col = $this->current_col_numbers($empty_cell_coords);
        $legal_col_numbers = array_diff(self::ALL_NUMBERS, $current_col);

        // list of non-zero values in the current square
        $current_square_numbers = $this->current_square_numbers($empty_cell_coords);
        $legal_square_numbers = array_diff(self::ALL_NUMBERS, $current_square_numbers);

        return array_values(array_intersect($legal_row_numbers,
                                            $legal_col_numbers, 
                                            $legal_square_numbers));
    }

    private function current_row_numbers($cell_coords)
    {
        return $this->board[$cell_coords->row];
    }

    private function current_col_numbers($cell_coords)
    {
        return array_map(function($row) use ($cell_coords) {
            return $row[$cell_coords->col]; }, $this->board);
    }

    private function current_square_numbers($cell_coords)
    {
        $square_numbers = [];

        $first_cell = self::first_cell_in_square($cell_coords);
        for ($i = 0; $i < self::SQUARE_DIM; ++$i) {
            $square_numbers = array_merge($square_numbers,
                array_slice($this->board[$first_cell->row + $i], $first_cell->col, self::SQUARE_DIM));
        }

        return $square_numbers;
    }

    private static function first_cell_in_square($cell_coords)
    {
        $sqr_r = floor($cell_coords->row / self::SQUARE_DIM) * self::SQUARE_DIM;
        $sqr_c = floor($cell_coords->col / self::SQUARE_DIM) * self::SQUARE_DIM;

        return new Cell($sqr_r, $sqr_c);
    }

    public function is_solved()
    {
        return is_null($this->find_next_empty_cell_coordinates());
    }
}

class Cell {
    public $row;
    public $col;

    public function __construct($row, $col) {
        $this->row = $row;
        $this->col = $col;
    }
}
