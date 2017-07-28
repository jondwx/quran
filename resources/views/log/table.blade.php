@foreach ($logs as $log)
    <?php
        $id = $log->id;
        $ip = $log->ip;
        $time = date('Y-m-d H:i:s', $log->time);
        $agent = parse_user_agent($log->agent);
        if (
            !$agent['platform']
            and
            !$agent['browser']
            and
            !$agent['version']
        ) {
            $agent = $log->agent;
        } else {
            $agent =
                $agent['platform'] . ' ' .
                $agent['browser'] . '(' .
                $agent['version'] . ')';
        }
        $host = $log->host;
        $uri = $log->uri;
    ?>
    <tr>
        <td>{{ $time }}</td>
        <td>{{ $agent }}</td>
        <td>{{ $host }}</td>
        <td>{{ $uri }}</td>
    </tr>
@endforeach
