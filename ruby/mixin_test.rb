module Test
  module Base
    def base(a)
      p a
    end
  end
end

module Test
  class A

    TEST = [:a, :aa]
    class << self
      include Base

      p self.ancestors
      def test_a
        base TEST
      end

    end
  end
end

module Test
  class B
    TEST = [:b, :bb]

    class << self
      include Base

      def test_b
        base TEST
      end
    end
  end
end

Test::A.test_a
Test::B.test_b
