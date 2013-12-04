
def foo(n)
  lambda { |i| n += i }
end

lambda_a = foo(2)
p lambda_a.call(3)
p lambda_a.call(3)

