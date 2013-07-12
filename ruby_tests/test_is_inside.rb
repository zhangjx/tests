# encoding: utf-8


def is_inside?(value)
  value = value.to_s.strip
  value =~ /^[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]@admaster\.com\.cn$/ ? true : false
end

value = 'test@admaster.com.cn'
value2 = 'test@gmail.com'
value3 = 'test@admster'

p is_inside?(value)
p is_inside?(value2)
