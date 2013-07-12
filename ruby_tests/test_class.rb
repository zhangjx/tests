class Birds
    attr_writer :name, :sex
    attr_reader :name, :sex
    attr_accessor :age

    def initialize name
        @name = name
    end

    def self.fly
        puts 'birds can flys'
    end

    def say
        puts "birds can say, I am #{@name}"
    end

    def age
      puts "birds age is #{@age}"
    end
end

birds = Birds.new('didi')
birds.sex = 'male'
birds.age = 12
birds.say
birds.age
Birds.fly
