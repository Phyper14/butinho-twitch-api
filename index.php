<?php
if(!array_key_exists('function', $_GET))
{
    echo 'Error. function missing.';
    exit;
}

$function = explode('/', $_GET['function']);
if(count($function) == 0 || $function[0] == "")
{
    echo 'Error. function missing.';
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

function curl_get_contents($uri)
{
  $ch = curl_init($uri);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

if($method === 'GET')
{
    switch($function[0])
    {
        case "followage":
            if(count($function) > 2)
            {
                if(!($function[1] == "" || $function[2] == ""))
                {
                    $channel = $function[1];
                    $user = $function[2];

                    $url = "https://api.2g.be/twitch/followage/$channel/$user?notext=1";
                    
                    $today_date = date("d/m/Y");
                    $follow_date = curl_get_contents($url);

                    $date = explode('/', $today_date);
                    $fdate = explode('-', $follow_date);
                    $ffdate = explode(' ', $fdate[2]);

                    $date0 = "$fdate[0]-$fdate[1]-$ffdate[0]";
                    $date1 = "$date[0]-$date[1]-$date[2]";

                    $diference = strtotime($date1) - strtotime($date0);
                    $days = floor($diference/(60 * 60 * 24));
                    
                    if($days > 365)
                    {
                        $years = floor($days/365);
                        $rest = floor($days%365);
                        if($rest > 30)
                        {
                            $months = floor($rest/30);
                            $days = floor($rest%30);

                            $output = "$user esta seguindo $channel ha $years anos, $months meses e $days dias.";
                            echo json_encode($output);
                        }
                    }
                    else
                    {
                        if($days > 30)
                        {
                            $months = floor($days/30);
                            $days = floor($days%30);

                            $output = "$user esta seguindo $channel ha $months meses e $days dias.";
                            echo json_encode($output);
                        }
                        else
                        {
                            $output = "$user esta seguindo $channel ha $days dias.";
                            echo json_encode($output);
                        }
                    }
                }
                else
                {
                    echo 'ERRRRRORRR';
                }
            }
            else
            {
                echo 'Error. missing parameters.';
                exit;
            }
        break;
        default:
            echo 'deu ruim';
    }
}