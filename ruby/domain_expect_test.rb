# encoding: utf-8

EXPECTED_LENGHT = 6
CHARSET = 'adfasdfasdf' # 'abcdefghinopqrstuvwxyz0123456789'
CHAR_TO_FILL = 'xxxx' # 'j'
SALT = 123456789 # 265358979
MAX_OLD_PLACEMENT_ID = 200000000

def get_checksum(number)
  result = ''

  while number > 0
    index = number % CHARSET.length
    result = CHARSET[index] + result
    number = (number / CHARSET.length).to_i
  end

  result_length = result.length
  if result_length < EXPECTED_LENGHT
    return CHAR_TO_FILL * (EXPECTED_LENGHT - result_length) + result
  elsif result_length > EXPECTED_LENGHT
    return result[-EXPECTED_LENGHT, EXPECTED_LENGHT]
  else
    return result
  end
end

def expected_domain(request_hash)
  number = (SALT + request_hash['b'].to_i + request_hash['i'].to_i + request_hash['m'].to_i) << 4
  return get_checksum(number)
end

def domain_validate(request_hash, host)
  return true unless request_hash['b'].to_i >= MAX_OLD_PLACEMENT_ID
  sub_domain = host[0..host.index('.')]
  return sub_domain == expected_domain(request_hash)
end

option = {'b' => 200160452, 'i' => 0, 'm' => 201}
p expected_domain(option)

option = {'b' => 200160452, 'i' => 1234, 'm' => 201}
p expected_domain(option)

option = {'b' => 200160452, 'i' => 1234, 'm' => 101}
p expected_domain(option)

option = {'b' => 200000000, 'i' => 0, 'm' => 201}
p expected_domain(option)

option = {'b' => 200000000, 'i' => 1234, 'm' => 201}
p expected_domain(option)

option = {'b' => 200000000, 'i' => 1234, 'm' => 101}
p expected_domain(option)
