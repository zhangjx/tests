a = [{id: 1, tid: 1}, {id: 2, tid: 2}]
a.each do |row|
  row[:name] = 'test'
  row[:t_name] = 'test_t'
end

p a
