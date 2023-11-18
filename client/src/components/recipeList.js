import React, {useEffect, useState} from 'react';

import Card from './card'


const RecipeList = ({ onRecipeCountChange }) => {
    const [recipes, setRecipes] = useState([]);
    const [selectedCards, setSelectedCards] = useState([]);
    const showButton = selectedCards.length >= 1;
    const url = 'https://hackatum23.moremaier.com/api/recipes'
    const numRecipes = 10;
    let indices = []
    const getRandom = (min, max) => {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    };

    for(let i =0; i <numRecipes; i++) {
        let randomNumber;
        do {
            randomNumber = getRandom(1, 30);
        } while (indices.includes(randomNumber));

        indices.push(getRandom(1,30));
    }

    const fetchAllRecipes = async (recipeID) => {
        try {
            const response = await fetch(`${url}/${recipeID}`);

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
            let allRecipes = [];
            // let recipesWithTags = [];
            for (let i = 0; i <numRecipes; i++){
                await fetchAllRecipes(indices[i]).then((response) => {
                    if(response){
                        allRecipes.push(response);
                    }
                });

            }
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

    useEffect(() => {
        // Notify the parent component when the number of selected recipes changes
        onRecipeCountChange(selectedCards.length);
    }, [selectedCards, onRecipeCountChange]);

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
            <div className="grid grid-cols-2 gap-5 p-5">
                {recipes && recipes.map(recipe => (
                    <Card recipe={recipe} onSelect={() => handleCardSelect(recipe)}
                          isSelected={selectedCards.some((selected) => selected.id === recipe.id)}/>
                ))}
            </div>
    );
};

export default RecipeList;