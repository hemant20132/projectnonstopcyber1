<script language="javascript" type="text/javascript">
            function dynamicdropdown(listindex)
            {
                document.getElementById("subcategory").length = 0;
                switch (listindex)
                {
                    case "Animals & Pet Supplies" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Animal Food","Animal Food");
                        document.getElementById("subcategory").options[1]=new Option("Animal Accessories","Animal Accessories");
                        break;
                    
                    case "Apparel & Accessories" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Clothing","Clothing");
                        document.getElementById("subcategory").options[2]=new Option("Clothing Accessories","Clothing Accessories");
                        break;

                    case "Arts & Entertainment" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Hobbies & Creative Arts","Hobbies & Creative Arts");
                        document.getElementById("subcategory").options[2]=new Option("Party & Celebration","Party & Celebration");

                    case "Baby & Toddler" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Baby Bathing & Body","Baby Bathing & Body");
                        document.getElementById("subcategory").options[2]=new Option("Baby Gift Sets","Baby Gift Sets");
                        document.getElementById("subcategory").options[3]=new Option("Baby Safety","Baby Safety");
                        document.getElementById("subcategory").options[4]=new Option("Baby Toys & Activity Equipment","Baby Toys & Activity Equipment");
                        document.getElementById("subcategory").options[5]=new Option("Baby Transport Accessories","Baby Transport Accessories");
                        document.getElementById("subcategory").options[6]=new Option("Diaperring","Diaperring");
                        document.getElementById("subcategory").options[7]=new Option("Nursing & Feeding","Nursing & Feeding");
                        break;

		            case "Business & Industrial" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Medical","Medical");
                        document.getElementById("subcategory").options[2]=new Option("Retail","Retail");
                        document.getElementById("subcategory").options[3]=new Option("Agriculture","Agriculture");
                        break;

                    case "Cameras & Optics" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Cameras & Optics Accessories","Cameras & Optics Accessories");
                        document.getElementById("subcategory").options[2]=new Option("Cameras","Cameras");
                        document.getElementById("subcategory").options[3]=new Option("Optics","Optics");
                        document.getElementById("subcategory").options[4]=new Option("Photography","Photography");
                        break;

                    case "Electronics" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Audio & Video Accessories","Audio & Video Accessories");
                        document.getElementById("subcategory").options[2]=new Option("Mobile Phones & Tablets","Mobile Phones & Tablets");
                        document.getElementById("subcategory").options[3]=new Option("Computers","Computers");
                        document.getElementById("subcategory").options[4]=new Option("Print, Copy, Scan & Fax","Print, Copy, Scan & Fax");
                        document.getElementById("subcategory").options[5]=new Option("Networking","Networking");
                        break;

                    case "Food, Beverages & Tobacco" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Beverages","Beverages");
                        document.getElementById("subcategory").options[2]=new Option("Food Items","Food Items");
                        document.getElementById("subcategory").options[3]=new Option("Tobacco","Tobacco");
                        break;

                    case "Furniture" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Beds & Accessories","Beds & Accessories");
                        document.getElementById("subcategory").options[2]=new Option("Dining Furniture & Accessories","Dining Furniture & Accessories");
                        document.getElementById("subcategory").options[3]=new Option("Cabinets & Storage","Cabinets & Storage");
                        document.getElementById("subcategory").options[4]=new Option("Sofa & Accessories","Sofa & Accessories");
                        break;

                    case "Hardware" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Building Materials","Building Materials");
                        document.getElementById("subcategory").options[2]=new Option("Hardware Accessories","Hardware Accessories");
                        document.getElementById("subcategory").options[3]=new Option("Tools & Tools Accessories","Tools & Tools Accessories");
                        document.getElementById("subcategory").options[4]=new Option("Locks & Keys","Locks & Keys");
                        document.getElementById("subcategory").options[5]=new Option("Power & Electrical Supplies","Power & Electrical Supplies");
                        break;

                    case "Health & Beauty" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Health Care","Health Care");
                        document.getElementById("subcategory").options[2]=new Option("Gift Sets","Gift Sets");
                        document.getElementById("subcategory").options[3]=new Option("Lotions & Moisturisers","Lotions & Moisturisers");
                        document.getElementById("subcategory").options[4]=new Option("Perfumes","Perfumes");
                        document.getElementById("subcategory").options[5]=new Option("Hand Care","Hand Care");
                        document.getElementById("subcategory").options[6]=new Option("Hand Sanitizers","Hand Sanitizers");
                        document.getElementById("subcategory").options[7]=new Option("Body Care","Body Care");
                        document.getElementById("subcategory").options[8]=new Option("Hair Care","Hair Care");
                        break;

                    case "Home & Garden" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Bathroom Accessories","Bathroom Accessories");
                        document.getElementById("subcategory").options[2]=new Option("DÉCOR","DÉCOR");
                        document.getElementById("subcategory").options[3]=new Option("Air Freshner","Air Freshner");
                        document.getElementById("subcategory").options[4]=new Option("Household Appliances","Household Appliances");
                        document.getElementById("subcategory").options[5]=new Option("Household Supplies","Household Supplies");
                        document.getElementById("subcategory").options[6]=new Option("Kitchen & Dining","Kitchen & Dining");
                        document.getElementById("subcategory").options[7]=new Option("Lawn & Garden","Lawn & Garden");
                        break;

                    case "Luggage & Bags" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Luggage","Luggage");
                        document.getElementById("subcategory").options[2]=new Option("Bags","Bags");
                        document.getElementById("subcategory").options[3]=new Option("Luggage & Bags Accessories","Luggage & Bags Accessories");
                        break;

                    case "Mature" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Erotic","Erotic");
                        document.getElementById("subcategory").options[2]=new Option("Weapons","Weapons");
                        break;

                    case "Media" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Print","Print");
                        document.getElementById("subcategory").options[2]=new Option("Audio","Audio");
                        document.getElementById("subcategory").options[3]=new Option("Video","Video");
                        break;

                    case "Office Supplies" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Office Accessories","Office Accessories");
                        document.getElementById("subcategory").options[2]=new Option("General Office Supplies","General Office Supplies");
                        document.getElementById("subcategory").options[3]=new Option("Office Equipments","Office Equipments");
                        break;

                    case "Religious & Ceremonial" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Religious Items","Religious Items");
                        document.getElementById("subcategory").options[2]=new Option("Memorial Ceremony Items","Memorial Ceremony Items");
                        break;

                    case "Software" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Computer Software","Computer Software");
                        document.getElementById("subcategory").options[2]=new Option("Antivirus","Antivirus");
                        break;

                    case "Sporting Goods" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Athletics","Athletics");
                        document.getElementById("subcategory").options[2]=new Option("Excercise & Fitness","Excercise & Fitness");
                        document.getElementById("subcategory").options[3]=new Option("Indoor Games","Indoor Games");
                        document.getElementById("subcategory").options[4]=new Option("Outdoor Recreation","Outdoor Recreation");
                        document.getElementById("subcategory").options[5]=new Option("Sporting Supplements","Sporting Supplements");
                        break;

                    case "Toys & Games" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Games","Games");
                        document.getElementById("subcategory").options[2]=new Option("Video Games","Video Games");
                        document.getElementById("subcategory").options[3]=new Option("Outdoor Play Equipment","Outdoor Play Equipment");
                        document.getElementById("subcategory").options[4]=new Option("Toys","Toys");
                        break;

                    case "Vehicles & Parts" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Vehicle Parts & Accessories","Vehicle Parts & Accessories");
                        document.getElementById("subcategory").options[2]=new Option("Vehicle Maintainance, Care & Decor","Vehicle Maintainance, Care & Decor");
                        document.getElementById("subcategory").options[3]=new Option("Vehicle Safety & Security","Vehicle Safety & Security");
                        break;

                    case "Fragrance" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Candles","Candles");
                        document.getElementById("subcategory").options[2]=new Option("Mists","Mists");
                        break;

                    case "Cosmetics" :
                        document.getElementById("subcategory").options[0]=new Option("Please select Subcategory","");
                        document.getElementById("subcategory").options[1]=new Option("Eye","Eye");
                        document.getElementById("subcategory").options[2]=new Option("Face","Face");
                        document.getElementById("subcategory").options[3]=new Option("Lips","Lips");
                        document.getElementById("subcategory").options[4]=new Option("Makeup Remover & Cleanser","Makeup Remover & Cleanser");
                        break;
                }
                return true;
            }
       </script>