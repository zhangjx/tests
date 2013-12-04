#!/usr/bin/env ruby
# encoding: utf-8

require "bunny"

conn = Bunny.new(:automatically_recover => false)
conn.start

ch   = conn.create_channel
p " [x] Awaiting RPC requests"

queue_name = "rpc_queue"
q = ch.queue(queue_name)
x = ch.default_exchange

q.subscribe(:block => true) do |delivery_info, properties, payload|
  n = payload.to_i

  p " [.] fib(#{n})"
  p properties
  p payload

  x.publish("#{n} ni mei a !", :routing_key => properties.reply_to, :correlation_id => properties.correlation_id)
end
