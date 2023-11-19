import {Inter} from 'next/font/google'
import Link from 'next/link';
import React, {useState} from "react";
import RecipeList from "@/components/recipeList";
import { useRouter } from 'next/router';
import {useSession} from "@/pages/SessionContext"; // Import the useRouter hook

const inter = Inter({subsets: ['latin']})

export default function Home() {
    const url = 'https://hackatum23.moremaier.com/api/chat-sessions'
    const [showButton, setShowButton] = useState(false);
    const { updateSessionData } = useSession();

    const requestOptions = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
    };
    const postSession = async () => {
        try {
            const response = await fetch(url, requestOptions);

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const sessionData = await response.json();
            return sessionData.data;

        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    const handleButtonClick = async () => {
        try {
            const session = await postSession();
            updateSessionData(session);
        } catch (error) {
            console.error('Error handling button click:', error);
        }
    };

    const handleRecipeCountChange = (newRecipeCount) => {
        // Update showButton state based on the new recipe count
        setShowButton(newRecipeCount >= 2);
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
            <RecipeList onRecipeCountChange={handleRecipeCountChange}/>
            {showButton && (
                <div className="fixed bottom-0">
                    <Link href="/chat">
                        <button onClick={handleButtonClick}
                                className="bg-greenPastel hover:bg-blue text-white font-bold py-2 px-4 rounded w-screen mr-5">
                            Continue...
                        </button>
                    </Link>
                </div>
            )}
        </div>
    );
}


