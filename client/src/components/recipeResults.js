import React, {useEffect, useState} from 'react';

import Card from './card'


const RecipeRating = () => {
    const [recipes, setRecipes] = useState([]);
    const [selectedCards, setSelectedCards] = useState([]);

    const url = 'https://hackatum23.moremaier.com/api/recipes'
    const fetchAllRecipes = async () => {
        try {
            const response = await fetch(url);

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const recipesData = await response.json();
            return recipesData.data;
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    };
    const fetchTagsForRecipe = async (recipeID) => {
        try {
            const response = await fetch(`${url}/${recipeID}/tags`);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const tagsData  = await response.json();
            return tagsData.data;
        } catch (error) {
            console.error('Error fetching data:', error);
        }

    };

    useEffect(() => {
        const fetchData = async () => {
            const allRecipes = await fetchAllRecipes();
            const recipesWithTags = await Promise.all(
                allRecipes.map(async (recipe) => {
                    const tags = await fetchTagsForRecipe(recipe.id);
                    return { ...recipe, tags };
                })
            );
            setRecipes(recipesWithTags);
        };

        fetchData();
    }, []);


    const handleCardSelect = (recipe) => {
        const isAlreadySelected = selectedCards.some((selected) => selected.id === recipe.id);

        if (isAlreadySelected) {
            const updatedSelection = selectedCards.filter((selected) => selected.id !== recipe.id);
            setSelectedCards(updatedSelection);
        } else if (selectedCards.length < 5) {
            setSelectedCards([...selectedCards, recipe]);
        }
    };

    return (
        <div className="w-full h-full bg-white">
            <div className="bg-greenPastel w-full h-full p-5 flex flex-col items-center justify-center">
                <img
                    src="https://img.hellofresh.com/f_auto,fl_lossy,q_auto/hellofresh_website/us/landing-pages/b2b/Hello_Fresh_White_Lockup_CMYK.png"
                    className="rounded-sm object-cover h-31 mt-10 "/>

                <span className="mt-10 font-bold text-xl text-active">Help us get to know you better</span>
                <span>Sort recipes based on your preferences</span>
            </div>
            <div className="grid grid-cols-2 gap-5 p-5">
                {recipes && recipes.map(recipe => (
                    <Card recipe={recipe} onSelect={() => handleCardSelect(recipe)}
                          isSelected={selectedCards.some((selected) => selected.id === recipe.id)}/>
                ))}

            </div>
        </div>
    );
};

export default RecipeRating;