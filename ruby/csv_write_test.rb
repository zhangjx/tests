require 'csv'

data = [{:name => 'ni mei a'}, {:name => 'test name'}]

CSV.open("./data/file.csv", "wb") do |csv|
  csv << ["row", "of", "CSV", "data"]
  data.each do |row|
    csv << row.values
  end
end
