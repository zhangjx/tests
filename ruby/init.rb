require "rubygems"
require "bundler"

ENV["RACK_ENV"] ||= "test"
Bundler.require(:default, ENV["RACK_ENV"].to_sym)
