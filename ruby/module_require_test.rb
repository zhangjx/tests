require './test_module_require_2'
require './test_module_require_3'

module Trackmaster
  module Base
    class Test

      def self.hello
        p "hello Trackmaster::Base::Test"
      end

      def self.hello_require
        User::Base.hello
      end

      def self.hello_require_2
        Master.hello
      end

    end
  end
end

Trackmaster::Base::Test.hello
Trackmaster::Base::Test.hello_require
Trackmaster::Base::Test.hello_require_2