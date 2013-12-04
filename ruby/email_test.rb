# encoding: utf-8
#
module RFC822
  QTEXT = '[^\\x0d\\x22\\x5c\\x80-\\xff]'
  DTEXT = '[^\\x0d\\x5b-\\x5d\\x80-\\xff]'
  ATOM = '[^\\x00-\\x20\\x22\\x28\\x29\\x2c\\x2e\\x3a-' +
    '\\x3c\\x3e\\x40\\x5b-\\x5d\\x7f-\\xff]+'
  QUOTED_PAIR = '\\x5c[\\x00-\\x7f]'
  DOMAIN_LITERAL = "\\x5b(?:#{DTEXT}|#{QUOTED_PAIR})*\\x5d"
  QUOTED_STRING = "\\x22(?:#{QTEXT}|#{QUOTED_PAIR})*\\x22"
  DOMAIN_REF = ATOM
  SUB_DOMAIN = "(?:#{DOMAIN_REF}|#{DOMAIN_LITERAL})"
  WORD = "(?:#{ATOM}|#{QUOTED_STRING})"
  DOMAIN = "#{SUB_DOMAIN}(?:\\x2e#{SUB_DOMAIN})*"
  LOCAL_PART = "#{WORD}(?:\\x2e#{WORD})*"
  ADDR_SPEC = "#{LOCAL_PART}\\x40#{DOMAIN}"

  EMAIL_REGEXP_WHOLE = Regexp.new("^#{ADDR_SPEC}$", nil, 'n')
  EMAIL_REGEXP_PART = Regexp.new("#{ADDR_SPEC}", nil, 'n')
end

class String
  def is_email?
    if RUBY_VERSION >= "1.9"
      (self.force_encoding("BINARY") =~ RFC822::EMAIL_REGEXP_WHOLE) != nil
    else
      (self =~ RFC822::EMAIL_REGEXP_WHOLE) != nil
    end
  end

  def contains_email?
    if RUBY_VERSION >= "1.9"
      (self.force_encoding("BINARY") =~ RFC822::EMAIL_REGEXP_PART) != nil
    else
      (self =~ RFC822::EMAIL_REGEXP_PART) != nil
    end
  end

  def scan_for_emails
    if RUBY_VERSION >= "1.9"
      self.force_encoding("BINARY").scan(RFC822::EMAIL_REGEXP_PART)
    else
      self.scan(RFC822::EMAIL_REGEXP_PART)
    end
  end

  # String REGEXP
  EMAIL_REGEXP = /^[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]@[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$/

  # A string is email
  #
  # if 'xxx'.is_email?
  def is_email2?
    (self.force_encoding("BINARY") =~ EMAIL_REGEXP2) != nil
  end
end

require 'mail'

def is_valid?(email)

  parser = Mail::RFC2822Parser.new
  parser.root = :addr_spec
  result = parser.parse(email)

  # Don't allow for a TLD by itself list (sam@localhost)
  # The Grammar is: (local_part "@" domain) / local_part ... discard latter
=begin
  result &&
     result.respond_to?(:domain) &&
     result.domain.dot_atom_text.elements.size > 1
=end

  result
end

b = 'test@admaster.com.cn'
p is_valid? b
#p a.is_email2?
