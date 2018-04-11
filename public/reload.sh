#!/usr/bin/env bash

ps aux | grep swoole_master|grep -v "grep" | awk '{print $2}' | xargs kill -USR1
