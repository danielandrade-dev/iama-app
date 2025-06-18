import { usePage } from "@inertiajs/react";
import { type Analist } from "@/types";

export default function AnalistsIndex() {
    const { analists } = usePage<Analist>().props;

    return (
        <div>
            <h1>Analistas</h1>
            <pre>{JSON.stringify(analists, null, 2)}</pre>
        </div>
    );
}