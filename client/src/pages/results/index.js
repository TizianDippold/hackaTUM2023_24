import RecipeResults from "@/components/recipeResults";
import {useSession} from "@/SessionContext";


export default function ResultsPage({ children }) {
    const { sessionData } = useSession();
    return (
        <RecipeResults sessionData={sessionData}/>
    );
}
