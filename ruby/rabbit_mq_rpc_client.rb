#!/usr/bin/env ruby
# encoding: utf-8

require "bunny"

conn = Bunny.new(:automatically_recover => false)
conn.start

ch   = conn.create_channel

x    = ch.default_exchange
server_queue   = "rpc_queue"
reply_queue    = ch.queue("", :exclusive => true)

def generate_uuid
  # very naive but good enough for code
  # examples
  "#{rand}#{rand}#{rand}"
end

p " [x] Requesting fib(30)"
n = 30

correlation_id = generate_uuid

x.publish(n.to_s,
  :routing_key    => server_queue,
  :correlation_id => correlation_id,
  :reply_to       => reply_queue.name)

response = nil
reply_queue.subscribe(:block => true) do |delivery_info, properties, payload|
  if properties[:correlation_id] == correlation_id
    response = payload

    delivery_info.consumer.cancel
  end
end

p " [.] Got #{response}"


ch.close
conn.close
