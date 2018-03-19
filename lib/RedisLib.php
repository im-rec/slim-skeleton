<?php

namespace Lib;

class RedisLib
{

    private $app;

    public function __construct($app){
        $this->redis = $app->get('redis');
    }

    /**
     * Untuk proses hash set redis
     *
     */
    public function set($key, $expiry, $index, $data)
    {
        // Set redis expired
        $this->redis->hSet($key, $index, json_encode($data));

        if (!empty($expiry)) {
            $this->redis->expire($key, intval($expiry));
        }

        return self::get($key);
    }

    /**
     * Untuk proses hash set multi redis
     *
     */
    public function setMulti($key, $expiry, $data)
    {
        // Set redis expired
        if (!empty($data)) {
            foreach ($data as $dkey => $dval) {
                $$this->redis->hSet($key, $dkey, json_encode($dval));
            }
        }

        if (!empty($expiry)) {
            $this->redis->expire($key, intval($expiry));
        }

        return self::get($key);
    }

    /**
     * Untuk proses hash set extend redis
     *
     */
    public function setExtend($key, $index, $data)
    {
        // extend current key
        return $this->redis->hSet($key, $index, json_encode($data));
    }

    /**
     * Untuk proses set redis
     *
    */
    public function setSingle($key, $expiry, $data)
    {
        // Set redis expired
        $this->redis->set($key, json_encode($data));

        if (!empty($expiry)) {
            $this->redis->expire($key, intval($expiry));
        }

        return self::getSingle($key);
    }

    /**
     * Untuk get value redis by hash keys
     *
     */
    public function get($key, $convertArray = false)
    {
        $result     = $this->redis->hGetall($key);
        foreach ($result as $key => $value) {
            $result[$key] = $convertArray ? json_decode($value, true) : json_decode($value);
        }
        return $result;
    }

    /**
     * Untuk get value redis by hash keys per index
     *
     */
    public function getIndex($key, $index)
    {
        $indexValue = $this->redis->hGet($key, $index);
        return $indexValue ? json_decode($indexValue) : [];
    }

    /**
     * Untuk proses get redis
     *
     */
    public function getSingle($key)
    {
        return json_decode($this->redis->get($key));
    }

    /**
     * Untuk proses delete redis by hash keys
     *
     */
    public function delete($key, $index)
    {
        $this->redis->hDel($key, $index);
        return self::get($key);
    }

    /**
     * Untuk proses delete redis by hash keys
     *
     */
    public function deleteMulti($key, $index)
    {
        if (!empty($index)) {
            foreach ($index as $value) {
                $this->redis->hDel($key, $value);
            }
        }
        return self::get($key);
    }

    /**
     * Untuk proses delete redis
     *
     */
    public function deleteAll($key)
    {
        return $this->redis->del($key);
    }

    /**
     * Untuk cek existing hash key redis
     *
     */
    public function exists($key, $index)
    {
        return $this->redis->hExists($key, $index);
    }

    /**
     * Untuk rename existing key
     *
     */
    public function rename($old_key, $new_key)
    {
        return $this->redis->rename($old_key, $new_key);
    }

    /**
     * Untuk proses set expire key redis
     *
     */
    public function expire($key, $expiry)
    {
        return $this->redis->expire($key, intval($expiry));
    }
}

