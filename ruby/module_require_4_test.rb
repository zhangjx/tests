
module Trackmaster
  module Base
    module Test

      def self.hello
        p "hello Trackmaster::Base::Test"
      end

      def self.hello_require
        Test_2.hello
      end

    end
  end
end

module Trackmaster
  module Base
    module Test_2

      def self.hello
        p "hello Trackmaster::Base::Test_2"
      end

    end
  end
end

Trackmaster::Base::Test.hello
Trackmaster::Base::Test.hello_require