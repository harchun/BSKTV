import { NextResponse } from 'next/server'
import { searchVenues } from '@/lib/data'
export async function GET(request:Request){const {searchParams}=new URL(request.url);const q=searchParams.get('q')||undefined;const city=searchParams.get('city')||undefined;const type=searchParams.get('type')||undefined;return NextResponse.json({data:searchVenues({q,city,type}),count:searchVenues({q,city,type}).length})}
