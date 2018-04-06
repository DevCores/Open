<?php

class ParseVote
{

    function __construct()
    {
        $this->model = new Model();
    }

    /**
     * @param $username
     * @param $urlMmotop
     * @param $idTop
     */
    function parseMmotop($username, $urlMmotop, $idTop)
    {
            $lines = @file($urlMmotop);
            if ($lines) {
                $lines = array_reverse($lines);
                foreach ($lines as $value) {
                    $arr = preg_split('/\s+/', $value, -1, PREG_SPLIT_NO_EMPTY);
                    if (preg_match("/" . $username . "/i", $value)) {
                        $timeVote = date('Y-m-d H:i:s', strtotime($arr['1'] . ' ' .  $arr['2']));
                        $voteUser = $this->model->getVoteLastDate($timeVote);
                        if ($voteUser['time_vote'] !=  $timeVote) {
                          $this->model->addVote( $arr['4'], $timeVote, $arr['3']);
                          break;
                        }
                    }
                }
            }

    }
}