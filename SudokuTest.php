<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once 'GameBoard.php';
require_once 'Game.php';

final class SudokuTest extends TestCase
{

    public function testNextMovesCase1(): void
    {
        $board = new GameBoard(0, 0, 8, 3, 4, 2, 9, 0, 0,
                               0, 0, 9, 0, 0, 0, 7, 0, 0,
                               4, 0, 0, 0, 0, 0, 0, 0, 3,
                               0, 0, 6, 4, 7, 3, 2, 0, 0,
                               0, 3, 0, 0, 0, 0, 0, 1, 0,
                               0, 0, 2, 8, 5, 1, 6, 0, 0,
                               7, 0, 0, 0, 0, 0, 0, 0, 8,
                               0, 0, 4, 0, 0, 0, 1, 0, 0,
                               0, 0, 3, 6, 9, 7, 5, 0, 0);
        $nextMove1 = new GameBoard(1, 0, 8, 3, 4, 2, 9, 0, 0,
                                   0, 0, 9, 0, 0, 0, 7, 0, 0,
                                   4, 0, 0, 0, 0, 0, 0, 0, 3,
                                   0, 0, 6, 4, 7, 3, 2, 0, 0,
                                   0, 3, 0, 0, 0, 0, 0, 1, 0,
                                   0, 0, 2, 8, 5, 1, 6, 0, 0,
                                   7, 0, 0, 0, 0, 0, 0, 0, 8,
                                   0, 0, 4, 0, 0, 0, 1, 0, 0,
                                   0, 0, 3, 6, 9, 7, 5, 0, 0);
        $nextMove2 = new GameBoard(5, 0, 8, 3, 4, 2, 9, 0, 0,
                                   0, 0, 9, 0, 0, 0, 7, 0, 0,
                                   4, 0, 0, 0, 0, 0, 0, 0, 3,
                                   0, 0, 6, 4, 7, 3, 2, 0, 0,
                                   0, 3, 0, 0, 0, 0, 0, 1, 0,
                                   0, 0, 2, 8, 5, 1, 6, 0, 0,
                                   7, 0, 0, 0, 0, 0, 0, 0, 8,
                                   0, 0, 4, 0, 0, 0, 1, 0, 0,
                                   0, 0, 3, 6, 9, 7, 5, 0, 0);
        $nextMove3 = new GameBoard(6, 0, 8, 3, 4, 2, 9, 0, 0,
                                   0, 0, 9, 0, 0, 0, 7, 0, 0,
                                   4, 0, 0, 0, 0, 0, 0, 0, 3,
                                   0, 0, 6, 4, 7, 3, 2, 0, 0,
                                   0, 3, 0, 0, 0, 0, 0, 1, 0,
                                   0, 0, 2, 8, 5, 1, 6, 0, 0,
                                   7, 0, 0, 0, 0, 0, 0, 0, 8,
                                   0, 0, 4, 0, 0, 0, 1, 0, 0,
                                   0, 0, 3, 6, 9, 7, 5, 0, 0);
        $this->assertEquals(
          $board->nextMoves(),
          [$nextMove1, $nextMove2, $nextMove3]
        );
    }

    public function testNextMovesCase2(): void
    {
        $board = new GameBoard(1, 0, 8, 3, 4, 2, 9, 0, 0,
                               0, 0, 9, 0, 0, 0, 7, 0, 0,
                               4, 0, 0, 0, 0, 0, 0, 0, 3,
                               0, 0, 6, 4, 7, 3, 2, 0, 0,
                               0, 3, 0, 0, 0, 0, 0, 1, 0,
                               0, 0, 2, 8, 5, 1, 6, 0, 0,
                               7, 0, 0, 0, 0, 0, 0, 0, 8,
                               0, 0, 4, 0, 0, 0, 1, 0, 0,
                               0, 0, 3, 6, 9, 7, 5, 0, 0);
        $nextMove1 = new GameBoard(1, 5, 8, 3, 4, 2, 9, 0, 0,
                                   0, 0, 9, 0, 0, 0, 7, 0, 0,
                                   4, 0, 0, 0, 0, 0, 0, 0, 3,
                                   0, 0, 6, 4, 7, 3, 2, 0, 0,
                                   0, 3, 0, 0, 0, 0, 0, 1, 0,
                                   0, 0, 2, 8, 5, 1, 6, 0, 0,
                                   7, 0, 0, 0, 0, 0, 0, 0, 8,
                                   0, 0, 4, 0, 0, 0, 1, 0, 0,
                                   0, 0, 3, 6, 9, 7, 5, 0, 0);
        $nextMove2 = new GameBoard(1, 6, 8, 3, 4, 2, 9, 0, 0,
                                   0, 0, 9, 0, 0, 0, 7, 0, 0,
                                   4, 0, 0, 0, 0, 0, 0, 0, 3,
                                   0, 0, 6, 4, 7, 3, 2, 0, 0,
                                   0, 3, 0, 0, 0, 0, 0, 1, 0,
                                   0, 0, 2, 8, 5, 1, 6, 0, 0,
                                   7, 0, 0, 0, 0, 0, 0, 0, 8,
                                   0, 0, 4, 0, 0, 0, 1, 0, 0,
                                   0, 0, 3, 6, 9, 7, 5, 0, 0);
        $nextMove3 = new GameBoard(1, 7, 8, 3, 4, 2, 9, 0, 0,
                                   0, 0, 9, 0, 0, 0, 7, 0, 0,
                                   4, 0, 0, 0, 0, 0, 0, 0, 3,
                                   0, 0, 6, 4, 7, 3, 2, 0, 0,
                                   0, 3, 0, 0, 0, 0, 0, 1, 0,
                                   0, 0, 2, 8, 5, 1, 6, 0, 0,
                                   7, 0, 0, 0, 0, 0, 0, 0, 8,
                                   0, 0, 4, 0, 0, 0, 1, 0, 0,
                                   0, 0, 3, 6, 9, 7, 5, 0, 0);
        $this->assertEquals(
          $board->nextMoves(),
          [$nextMove1, $nextMove2, $nextMove3]
        );
    }

    public function testNextMovesCase3(): void
    {
        $board = new GameBoard(1, 5, 8, 3, 4, 2, 9, 0, 0,
                               0, 0, 9, 0, 0, 0, 7, 0, 0,
                               4, 0, 0, 0, 0, 0, 0, 0, 3,
                               0, 0, 6, 4, 7, 3, 2, 0, 0,
                               0, 3, 0, 0, 0, 0, 0, 1, 0,
                               0, 0, 2, 8, 5, 1, 6, 0, 0,
                               7, 0, 0, 0, 0, 0, 0, 0, 8,
                               0, 0, 4, 0, 0, 0, 1, 0, 0,
                               0, 0, 3, 6, 9, 7, 5, 0, 0);
        $nextMove1 = new GameBoard(1, 5, 8, 3, 4, 2, 9, 6, 0,
                                   0, 0, 9, 0, 0, 0, 7, 0, 0,
                                   4, 0, 0, 0, 0, 0, 0, 0, 3,
                                   0, 0, 6, 4, 7, 3, 2, 0, 0,
                                   0, 3, 0, 0, 0, 0, 0, 1, 0,
                                   0, 0, 2, 8, 5, 1, 6, 0, 0,
                                   7, 0, 0, 0, 0, 0, 0, 0, 8,
                                   0, 0, 4, 0, 0, 0, 1, 0, 0,
                                   0, 0, 3, 6, 9, 7, 5, 0, 0);
        $this->assertEquals(
          $board->nextMoves(),
          [$nextMove1]
        );
    }

    public function testSolveCase1(): void
    {
        $board = new GameBoard(0, 0, 8, 3, 4, 2, 9, 0, 0,
                               0, 0, 9, 0, 0, 0, 7, 0, 0,
                               4, 0, 0, 0, 0, 0, 0, 0, 3,
                               0, 0, 6, 4, 7, 3, 2, 0, 0,
                               0, 3, 0, 0, 0, 0, 0, 1, 0,
                               0, 0, 2, 8, 5, 1, 6, 0, 0,
                               7, 0, 0, 0, 0, 0, 0, 0, 8,
                               0, 0, 4, 0, 0, 0, 1, 0, 0,
                               0, 0, 3, 6, 9, 7, 5, 0, 0);
        $solvedBoard = new GameBoard(6, 7, 8, 3, 4, 2, 9, 5, 1,
                                     3, 2, 9, 1, 8, 5, 7, 6, 4,
                                     4, 5, 1, 7, 6, 9, 8, 2, 3,
                                     5, 1, 6, 4, 7, 3, 2, 8, 9,
                                     8, 3, 7, 9, 2, 6, 4, 1, 5,
                                     9, 4, 2, 8, 5, 1, 6, 3, 7,
                                     7, 6, 5, 2, 1, 4, 3, 9, 8,
                                     2, 9, 4, 5, 3, 8, 1, 7, 6,
                                     1, 8, 3, 6, 9, 7, 5, 4, 2);
        $this->assertEquals(
          Game::solve($board),
          $solvedBoard
        );
    }

    public function testSolveCase2(): void
    {
        $board = new GameBoard(0, 0, 4, 0, 0, 0, 5, 0, 0,
                               0, 7, 0, 2, 0, 0, 3, 6, 0,
                               8, 0, 0, 0, 0, 1, 0, 0, 0,
                               6, 2, 9, 0, 0, 0, 0, 3, 0,
                               0, 0, 0, 0, 6, 0, 0, 0, 0,
                               0, 4, 0, 0, 0, 0, 6, 1, 8,
                               0, 0, 0, 7, 0, 0, 0, 0, 6,
                               0, 1, 3, 0, 0, 4, 0, 2, 0,
                               0, 0, 2, 0, 0, 0, 4, 0, 0);
        $solvedBoard = new GameBoard(2, 3, 4, 9, 7, 6, 5, 8, 1,
                                     9, 7, 1, 2, 8, 5, 3, 6, 4,
                                     8, 5, 6, 4, 3, 1, 2, 9, 7,
                                     6, 2, 9, 1, 4, 8, 7, 3, 5,
                                     1, 8, 5, 3, 6, 7, 9, 4, 2,
                                     3, 4, 7, 5, 9, 2, 6, 1, 8,
                                     4, 9, 8, 7, 2, 3, 1, 5, 6,
                                     7, 1, 3, 6, 5, 4, 8, 2, 9,
                                     5, 6, 2, 8, 1, 9, 4, 7, 3);

        $this->assertEquals(
          Game::solve($board),
          $solvedBoard
        );
    }

    // public function testFirstIndexInSquare() : void
    // {
    //     $this->assertEquals(GameBoard::first_index_in_square(0), 0);
    //     $this->assertEquals(GameBoard::first_index_in_square(1), 0);
    //     $this->assertEquals(GameBoard::first_index_in_square(2), 0);
    //     $this->assertEquals(GameBoard::first_index_in_square(0+9), 0);
    //     $this->assertEquals(GameBoard::first_index_in_square(1+9), 0);
    //     $this->assertEquals(GameBoard::first_index_in_square(2+9), 0);
    //     $this->assertEquals(GameBoard::first_index_in_square(0+2*9), 0);
    //     $this->assertEquals(GameBoard::first_index_in_square(1+2*9), 0);
    //     $this->assertEquals(GameBoard::first_index_in_square(2+2*9), 0);

    //     $this->assertEquals(GameBoard::first_index_in_square(30), 30);
    //     $this->assertEquals(GameBoard::first_index_in_square(31), 30);
    //     $this->assertEquals(GameBoard::first_index_in_square(32), 30);
    //     $this->assertEquals(GameBoard::first_index_in_square(30+9), 30);
    //     $this->assertEquals(GameBoard::first_index_in_square(31+9), 30);
    //     $this->assertEquals(GameBoard::first_index_in_square(32+9), 30);
    //     $this->assertEquals(GameBoard::first_index_in_square(30+2*9), 30);
    //     $this->assertEquals(GameBoard::first_index_in_square(31+2*9), 30);
    //     $this->assertEquals(GameBoard::first_index_in_square(32+2*9), 30);

    //     $this->assertEquals(GameBoard::first_index_in_square(60), 60);
    //     $this->assertEquals(GameBoard::first_index_in_square(61), 60);
    //     $this->assertEquals(GameBoard::first_index_in_square(62), 60);
    //     $this->assertEquals(GameBoard::first_index_in_square(60+9), 60);
    //     $this->assertEquals(GameBoard::first_index_in_square(61+9), 60);
    //     $this->assertEquals(GameBoard::first_index_in_square(62+9), 60);
    //     $this->assertEquals(GameBoard::first_index_in_square(60+2*9), 60);
    //     $this->assertEquals(GameBoard::first_index_in_square(61+2*9), 60);
    //     $this->assertEquals(GameBoard::first_index_in_square(62+2*9), 60);
    // }
}