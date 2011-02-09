<?php

function shortenArray($arr)
{
    $ret = array();

    $buf = null;

    # Jedes Array Element durchgehen
    #while($val = array_shift($arr))
    foreach($arr as $val)
    {
        $nextval = next($arr);

        # Differenz zwischen aktuellen und nächsten value berechnen
        $diff = abs($nextval - $val);

        # Wenn buf bereits vorhanden und nächster Diff nicht mehr 1 dann buf abschließen
        if($buf && $diff != 1)
        {
            $ret[] = $buf . $val;
            $buf = null;
            continue;
        }

        # Wenn diff ist 1
        if($diff == 1)
        {
            # Wenns den Buffer noch nicht gibt - anlegen
            if(!$buf)
            {
                $buf = $val . "-";
            }
            continue;
        }

        # Wenn diff nicht 1, Wert ans Ergebnissarray hängen
        $ret[] = $val;
    }

    return $ret;
}

function unshortenArray($arr)
{
    $ret = array();

    foreach($arr as $val)
    {
        $position = strpos($val, '-');

        # Wenn kein "-" vorkommt einfach Wert anhängen
        if($position === false)
        {
            $ret[] = $val;
        }
        else
        {
            # Alle Werte von bis anhängen
            $from = substr($val, 0, $position);

            $to = substr($val, $position+1);

            # Lambda Funktion zum vorwärts oder rückwärts zählen
            $countFunction = function ($start, $end, $add = true)
            {
                $ret = array();

                if($add)
                {
                    while($start <= $end)
                    {
                        $ret[] = $start++;
                    }
                }
                else
                {
                    while($start >= $end)
                    {
                        $ret[] = $start--;
                    }
                }

                return $ret;
            };

            # Zhlfunktion ausführen
            $arrayPart = $countFunction($from, $to, ($from < $to));

            # Mergen
            $ret = array_merge($ret, $arrayPart);
        }
    }

    return $ret;
}
