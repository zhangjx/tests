module Body
    class Birds
        PI = 3.14

        def fly
            p 'I can fly'
        end

        module LittleBird
            def self.run
                p 'I can run'
            end
        end
    end

    def cat
        p 'i am cat'
    end

    module Content
        def self.dog
            p 'I am dog'
        end
    end
end

class Used
    include Body
end

Used.new.cat
Body::Birds.new.fly
p Body::Birds::PI
Body::Birds::LittleBird.run
Body::Content.dog
