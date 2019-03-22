<?php
namespace FlowCp;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Flow
{
    public static function get_component_status($server)
    {
        $cfg = config('flow.servers');
        if (!isset($cfg[$server])) {
            throw new \Exception('Attempted to check status of nonexsitent server.');
        }
        $cfg = $cfg[$server];

        try {
            $status = fsockopen($cfg['hostname'], $cfg['port'], $errno, $errstr, 1);
            return $status !== false;
        } catch (\ErrorException $e) {
            return false;
        }
    }

    public static function get_server_status()
    {
        return Cache::remember('server_status', config('flow.server_status_cache_time'), function () {
            return [
                'login' => get_component_status('login'),
                'char' => get_component_status('char'),
                'map' => get_component_status('map'),
            ];
        });
    }

    public static function get_online_users()
    {
        return Cache::remember('online_count', 1, function () {
            return DB::table('char')->where('online', 1)->count();
        });
    }

    public static function get_account_count()
    {
        return Cache::remember('account_count', 1, function () {
            return DB::table('login')->count();
        });
    }

    private static function read_git_hash()
    {
        $ret = 'Unknown Git Hash';
        try {
            $hash = file_get_contents(base_path('.git/refs/heads/master'));
            if (!empty($hash)) {
                if (strlen($hash) > 7) {
                    $ret = substr($hash, 0, 7);
                } else {
                    $ret = $hash;
                }
            }
        } catch (\ErrorException $e) {

        } finally {
            return $ret;
        }
    }

    public static function get_flow_version()
    {
        return Cache::remember('git_hash', 1, function () {
            return self::read_git_hash();
        });
    }
}
