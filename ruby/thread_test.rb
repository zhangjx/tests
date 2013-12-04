thr = Thread.new { puts "Whats the big deal" }
p thr.status
thr.join
p thr.status
