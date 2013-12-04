module Test
  class Init
    def initialize a, b, c
      p 'tt'
      @a = a
      @b = b
      @c = c
      p 'tt2'
      p @a
      p @b
      p @c
    end
  end
end

Test::Init.new('aa', 'bb', 'cc')