require 'sinatra'
before do
  p params
end

get '/' do
  p 'get'
end

