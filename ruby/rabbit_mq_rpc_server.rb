#!/usr/bin/env ruby
# encoding: utf-8

require "bunny"

conn = Bunny.new
conn.start

ch   = conn.create_channel

class RabbitmqRpcServer

  def initialize(ch)
    @ch = ch
  end

  def start(queue_name)
    @q = @ch.queue(queue_name)
    @x = @ch.default_exchange

    @q.subscribe(:block => true) do |delivery_info, properties, payload|
      n = payload.to_i

      p " [.] receive (#{n})"
      #p properties
      #p payload

      @x.publish("#{n} ni mei a !", :routing_key => properties.reply_to, :correlation_id => properties.correlation_id)
    end
  end
end

begin
  server = RabbitmqRpcServer.new(ch)
  p " [x] Awaiting RPC requests"
  server.start("rpc_queue")
rescue Interrupt => _
  ch.close
  conn.close
end
