import RecipeResults from "@/components/recipeResults";
import {useSession} from "@/pages/SessionContext";


export default function ResultsPage({ children }) {
    const { sessionData } = useSession();
    return (
        <RecipeResults sessionData={sessionData}/>
    );
}
