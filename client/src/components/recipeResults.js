import React, {useEffect, useState} from 'react';

import BigCard from "./bigCard";


const RecipeResults = () => {
    const [recipes, setRecipes] = useState([]);
    const [loading, setLoading] = useState(true);
    const [found, setFound] = useState(false);
    const url = 'https://hackatum23.moremaier.com/api'

    const fetchChatResults = async () => {
        try {
            const response = await fetch(`${url}/chat-sessions/1/results`, {
                headers: {
                    "Content-Type": "application/json; charset=UTF-8",
                    "Accept": "application/json",
                }
            });
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
            const allRecipes = await fetchChatResults();
            allRecipes.splice(3);
            setRecipes(prevState => allRecipes);
            setLoading(false);
            const foundRecipes = (allRecipes.length > 0);
            setFound(foundRecipes);
        };
        fetchData();
    }, []);


    // const handleCardSelect = (recipe) => {
    //     const isAlreadySelected = selectedCards.some((selected) => selected.id === recipe.id);
    //
    //     if (isAlreadySelected) {
    //         const updatedSelection = selectedCards.filter((selected) => selected.id !== recipe.id);
    //         setSelectedCards(updatedSelection);
    //     } else if (selectedCards.length < 5) {
    //         setSelectedCards([...selectedCards, recipe]);
    //     }
    // };

    return (
        <div className="w-full h-full bg-white">
            <div className="bg-greenPastel w-full h-full p-5 flex flex-col items-center justify-center">
                <img
                    src="https://img.hellofresh.com/f_auto,fl_lossy,q_auto/hellofresh_website/us/landing-pages/b2b/Hello_Fresh_White_Lockup_CMYK.png"
                    className="rounded-sm object-cover h-31 mt-10 "/>

                <span className="mt-10 font-bold text-xl text-active"> {
                    loading ? 'Loading...' : found ? 'Here are some recipes!' : 'Sorry, no recipes found!'
                }</span>
            </div>
            <div className="grid grid-cols-1 gap-5 p-5">
                {recipes && recipes.map(recipe => (
                    <BigCard recipe={recipe}/>
                ))}

            </div>
        </div>
    );
};

export default RecipeResults;