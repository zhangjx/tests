require 'rubygems'
require 'sequel'
require 'logger'
require 'mysql2'

def connect
  db = Sequel.mysql2('test', user: 'test', password: 'test', host: '127.0.0.1')
  dataset = db[:sp_file]
  dataset
end

def insert dataset
  (1..100).each do |i|
    dataset.insert(name: 'test_name' + i.to_s)
  end
  nil
end

dataset = connect()

#insert(dataset)
dataset.limit(10, 0).each do |y|
  p y
end
