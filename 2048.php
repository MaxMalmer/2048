<?php
/**
 * Kattis Problem: https://open.kattis.com/problems/2048
 * Author: Max Malmer, maxmalmer@live.se
 */

class Board {

    private $board;
    private $move;
    private $board_string;

    function __construct($stdin) {

        for ($i = 0; $i < 4; $i++) {
            fscanf($stdin, "%[^\n]", $array);
            $this->board[] = array_map("intval", explode(' ', $array));
        }
        fscanf($stdin, "%[^\n]", $array);
        $array = array_map("intval", explode(' ', $array));
        $this->move = $array[0];
    }

    function print_board() {

        for ($i = 0; $i < 4; $i++) {

            for ($j = 0; $j < 4; $j++) {
                $this->board_string .= strval($this->board[$i][$j]);
                $this->board_string .= " ";
                
                if ($j == 3) {
                    $this->board_string .= "\n";
                } 
            }
        }

        echo $this->board_string;
    }

    function update_board() {

        if ($this->move == 0) {
            $this->update_left();
        } else if ($this->move == 1) {
            $this->update_up();
        } else if ($this->move == 2) {
            $this->update_right();
        } else if ($this->move == 3) {
            $this->update_down();
        }
    }

    function update_left() {

        for ($i = 0; $i < 4; $i++) {

            for ($j = 0; $j < 4; $j++) {
                
                if ($this->board[$i][$j] == 0) {
                    continue;
                }

                for ($k = $j + 1; $k < 4; $k++) {

                    if ($this->board[$i][$k] == 0) {
                        continue;
                    } else if ($this->board[$i][$k] == $this->board[$i][$j]) {
                        $this->board[$i][$j] = 2 * $this->board[$i][$j];
                        $this->board[$i][$k] = 0;
                        break;
                    } else {
                        break;
                    }
                }

                for ($k = 0; $k < $j; $k++) {

                    if ($this->board[$i][$k] == 0) {
                        $this->board[$i][$k] = $this->board[$i][$j];
                        $this->board[$i][$j] = 0;
                        break;
                    }
                }
            }
        }
    }

    function update_up() {

        for ($i = 0; $i < 4; $i++) {

            for ($j = 0; $j < 4; $j++) {
                
                if ($this->board[$j][$i] == 0) {
                    continue;
                }

                for ($k = $j + 1; $k < 4; $k++) {

                    if ($this->board[$k][$i] == 0) {
                        continue;
                    } else if ($this->board[$k][$i] == $this->board[$j][$i]) {
                        $this->board[$j][$i] = 2 * $this->board[$j][$i];
                        $this->board[$k][$i] = 0;
                        break;
                    } else {
                        break;
                    }
                }

                for ($k = 0; $k < $j; $k++) {
                    
                    if ($this->board[$k][$i] == 0) {
                        $this->board[$k][$i] = $this->board[$j][$i];
                        $this->board[$j][$i] = 0;
                        break;
                    }
                }
            }
        }
    }

    function update_right() {

        for ($i = 0; $i < 4; $i++) {

            for ($j = 3; $j >= 0; $j--) {
                
                if ($this->board[$i][$j] == 0) {
                    continue;
                }

                for ($k = $j - 1; $k >= 0; $k--) {

                    if ($this->board[$i][$k] == 0) {
                        continue;
                    } else if ($this->board[$i][$k] == $this->board[$i][$j]) {
                        $this->board[$i][$j] = 2 * $this->board[$i][$j];
                        $this->board[$i][$k] = 0;
                        break;
                    } else {
                        break;
                    }
                }

                for ($k = 3; $k > $j; $k--) {

                    if ($this->board[$i][$k] == 0) {
                        $this->board[$i][$k] = $this->board[$i][$j];
                        $this->board[$i][$j] = 0;
                        break;
                    }
                }
            }
        }
    }

    function update_down() {

        for ($i = 0; $i < 4; $i++) {

            for ($j = 3; $j >= 0; $j--) {
                
                if ($this->board[$j][$i] == 0) {
                    continue;
                }

                for ($k = $j - 1; $k >= 0; $k--) {

                    if ($this->board[$k][$i] == 0) {
                        continue;
                    } else if ($this->board[$k][$i] == $this->board[$j][$i]) {
                        $this->board[$j][$i] = 2 * $this->board[$j][$i];
                        $this->board[$k][$i] = 0;
                        break;
                    } else {
                        break;
                    }
                }

                for ($k = 3; $k > $j; $k--) {
                    
                    if ($this->board[$k][$i] == 0) {
                        $this->board[$k][$i] = $this->board[$j][$i];
                        $this->board[$j][$i] = 0;
                        break;
                    }
                }
            }
        }
    }
}

$stdin = fopen("php://stdin", "r");
$board = new Board($stdin);
$board->update_board();
$board->print_board();
?>