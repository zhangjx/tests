require 'pry'

class Pig
  def say_hello
    p 'hello!'
  end

  def eat
    "mom wow"
  end

end

a = Pig.new

binding.pry

p 'Hello World!'
