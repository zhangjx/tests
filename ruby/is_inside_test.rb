# encoding: utf-8


def is_inside?(value)
  value = value.to_s.strip
  value =~ /^[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]@baidu\.com$/ ? true : false
end

value = 'test@baidu.com'
value2 = 'test@gmail.com'
value3 = 'test@baidu'

p is_inside?(value)
p is_inside?(value2)
