require './test_class.rb'

class LittleBirds < Birds
    def initialize name
        super(name)
    end
end

littleBird = LittleBirds.new('littleBird')
littleBird.say
